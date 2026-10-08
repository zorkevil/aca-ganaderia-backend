# Convenciones de desarrollo — Backend Laravel (estilo ACA Ganadería)

Este documento describe la forma de trabajar de este proyecto para que cualquier
trabajo nuevo (en este repo o en uno nuevo que lo tome como referencia) mantenga
la misma consistencia. Está escrito para que Claude lo cargue como contexto de
proyecto y replique el estilo desde el primer archivo que toque.

## Stack

- Laravel 12, PHP 8.2+
- Auth web: Laravel Breeze (sesión, Blade)
- Auth API: Laravel Sanctum (tokens simples, sin refresh token)
- Base de datos: MySQL
- Frontend admin: Blade + Vite (no Inertia, no Livewire)
- Frontend público: consumidor externo (Next.js) que pega contra `routes/api.php`
- Colas: `ShouldQueue` + `database`/`sync` driver, jobs simples
- Sin capa de "Service" ni "Repository" salvo para integraciones externas
  puntuales (ver `app/Services/Mag/MagClient.php` para un ejemplo: un cliente
  HTTP a una API externa, no un service layer genérico de negocio)

## Arquitectura: dos caras de la misma app

El backend sirve **dos consumidores distintos** desde el mismo Laravel:

1. **Admin** (`app/Http/Controllers/Admin/...`): panel interno, autenticado por
   sesión (`auth` middleware + `admin` middleware), Blade + Vite. Los
   controllers acá casi nunca tienen `index`/`show` propios por recurso — esas
   vistas suelen resolverse en un controller "hub" de la sección (p.ej.
   `ConfigurationController@index`, `HomeController@index`) que arma todo el
   listado para la pantalla. Los controllers de recurso individual
   (`CategoryController`, `AllianceController`, etc.) solo implementan
   `store` / `update` / `destroy`.
2. **Api** (`app/Http/Controllers/Api/...`): API pública/consumida por el
   frontend externo, autenticada con Sanctum, responde JSON vía API Resources.
   Estos controllers son de solo lectura casi siempre (`index`, `show`), salvo
   excepciones puntuales que sí reciben POST desde el sitio público (p. ej.
   formulario de contacto).

No mezclar: un recurso que necesita pantalla de admin Y exposición pública
tiene **dos controllers separados** (`Admin/.../XController` y
`Api/ApiXController`), cada uno con su propia carpeta y sus propios Form
Requests/Resources donde aplique.

## Estructura de carpetas

```
app/
  Http/
    Controllers/
      Admin/
        <Area>/<Entity>Controller.php     # Area = agrupador temático: Configuration, Home, Products, Reports, Sections
      Api/
        Api<Entity>Controller.php         # todo en un mismo namespace Api, sin subcarpetas
      Auth/                               # controllers de Breeze, no tocar el patrón
      Controller.php                      # clase abstracta vacía, todos extienden de acá
    Middleware/
      AdminMiddleware.php                 # alias 'admin', valida is_admin
    Requests/
      Admin/<Area>/<Entity(plural)>/Store<Entity>Request.php
      Admin/<Area>/<Entity(plural)>/Update<Entity>Request.php
      Api/Store<Entity>Request.php        # los pocos POST públicos
    Resources/
      <Entity>Resource.php                # planos, sin subcarpetas, uno por entidad expuesta en API
  Models/
    <Entity>.php                          # singular, sin sufijo
  Jobs/
    <Verbo><Entity>.php                   # p.ej. ProcessContactForms, SyncMagPreciosCategorias
  Services/
    <Integracion>/<Nombre>Client.php      # solo para clientes de servicios externos
database/
  migrations/                             # una tabla por migración de create, migraciones separadas add_x_to_y para alters
  seeders/                                # un seeder puntual por feature que lo necesita, no todo pasa por DatabaseSeeder
  factories/                              # solo donde hace falta para tests/seeders
routes/
  web.php                                 # admin, agrupado con name('admin.') y prefix('admin')
  api.php                                 # api pública, agrupado con prefix() por dominio
```

## Naming

- **Namespaces/carpetas de Requests**: la carpeta va en **plural** del recurso
  (`Categories`, `Subcategories`, `AuctionModality` es la excepción — revisar
  caso a caso, pero por defecto usar plural), la clase es
  `Store<Entity>Request` / `Update<Entity>Request` en singular.
- **Controllers API**: siempre prefijo `Api` pegado al nombre
  (`ApiCategoryController`, no `Api\CategoryController` con clase
  `CategoryController` — el prefijo va en el nombre de clase también, porque
  conviven en el mismo namespace `Api` sin subcarpetas).
- **Rutas admin**: paths en **español** (`/productos`, `/informes`,
  `/configuracion`), pero `name()` en **inglés** (`admin.products.index`,
  `admin.reports.store`). Comentarios en mayúsculas tipo
  `// BLOQUE PRODUCTOS` para separar secciones dentro de `web.php`.
- **Rutas api**: paths en inglés/kebab (`/products`, `/general-categories`,
  `/auctions-modalities`), agrupadas con `Route::prefix()` por dominio,
  comentario en español arriba de cada bloque explicando qué es.
- **Mensajes de usuario** (`->with('status', ...)`, excepciones de validación,
  logs de negocio): siempre en **español**.
- **Código** (variables, métodos, nombres de clase): siempre en **inglés**,
  salvo campos de dominio que ya nacieron en español en la base de datos
  (`nombre`, `apellido`, `enviado` en `ContactForm` — no forzar traducción de
  columnas existentes, pero para tablas nuevas preferir inglés salvo que el
  dominio del cliente use un término en español que no tiene traducción obvia).
- **Comentarios en código**: cortos, en español, solo cuando el porqué no es
  obvio (ver `ApiCategoryController`: `// Filtro opcional por sección
  (nutricion / sanidad)`).

## Patrón: Controller Admin (CRUD de un recurso de configuración)

```php
namespace App\Http\Controllers\Admin\<Area>;

use App\Http\Controllers\Controller;
use App\Models\<Entity>;
use App\Http\Requests\Admin\<Area>\<Entities>\Store<Entity>Request;
use App\Http\Requests\Admin\<Area>\<Entities>\Update<Entity>Request;
use Illuminate\Http\RedirectResponse;

class <Entity>Controller extends Controller
{
    public function store(Store<Entity>Request $request): RedirectResponse
    {
        $entity = new <Entity>($request->validated());
        $entity->syncImage($request->file('icon'), 'icon_path'); // si el recurso tiene imagen (ver patrón HasImageUpload)
        $entity->save();

        return redirect()
            ->route('admin.<area>.index')
            ->with('status', '<Entity> creada.');
    }

    public function update(Update<Entity>Request $request, <Entity> $<entity>): RedirectResponse
    {
        $<entity>->fill($request->validated());
        $<entity>->syncImage($request->file('icon'), 'icon_path'); // si el recurso tiene imagen
        $<entity>->save();

        return redirect()
            ->route('admin.<area>.index')
            ->with('status', '<Entity> actualizada.');
    }

    public function destroy(<Entity> $<entity>): RedirectResponse
    {
        $<entity>->delete();

        return redirect()
            ->route('admin.<area>.index')
            ->with('status', '<Entity> eliminada.');
    }
}
```

Notas:
- Route model binding siempre por el parámetro tipado (`<Entity> $<entity>`),
  nunca buscar por id manualmente.
- El redirect siempre vuelve al índice de la sección con un mensaje de status
  en español vía flash session (`with('status', ...)`), consumido en la vista
  Blade como notificación.

## Patrón: Controller Api (solo lectura)

```php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\<Entity>Resource;
use App\Models\<Entity>;
use Illuminate\Http\Request;

class Api<Entity>Controller extends Controller
{
    public function index(Request $request)
    {
        $query = <Entity>::query()
            ->active()
            ->with(['<relaciones necesarias>'])
            ->orderBy('<campo>');

        if ($request->filled('<filtro>')) {
            $query->whereHas('<relacion>', fn ($q) => $q->where('slug', $request-><filtro>));
        }

        return <Entity>Resource::collection($query->get());
    }

    public function show(string $slug)
    {
        $entity = <Entity>::active()->where('slug', $slug)->firstOrFail();

        return new <Entity>Resource($entity);
    }
}
```

Notas:
- Sin paginación salvo que el volumen lo justifique (el código deja el patrón
  de paginación comentado como referencia cuando no se usa — ver
  `ApiProductController`).
- Filtros por query string con `$request->filled(...)`, nunca acceso directo
  sin chequear presencia.
- Siempre filtrar `is_active` en las consultas públicas.

## Patrón: Form Requests

```php
namespace App\Http\Requests\Admin\<Area>\<Entities>;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // solo en Update, para unique()->ignore()

class Store<Entity>Request extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'campo' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:<tabla>,slug'],
            'is_active' => ['required', 'boolean'],
            'icon' => ['nullable', 'file', 'mimes:svg,svg+xml,jpg,jpeg,png,webp', 'max:5120'],
        ];
    }
}
```

En `Update<Entity>Request`, el unique lleva `Rule::unique(...)->ignore($this-><entity>->id)`,
usando el nombre del parámetro de ruta (route model binding implícito
disponible en `$this` dentro del FormRequest).

Reglas siempre como array (`['required', 'string', ...]`), no como string
pipe-separado, salvo en validaciones inline sueltas (`$request->validate([...])`
con string, como en `ApiAuthController@login` — eso solo pasa cuando no amerita
un FormRequest dedicado, por ejemplo login).

## Patrón: API Resources

```php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class <Entity>Resource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->slug,          // el frontend público suele consumir el slug como id
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon_url,    // accessor del modelo, nunca el path crudo
            'href' => '/' . $this->relacion?->slug . '/' . $this->slug,
        ];
    }
}
```

Notas: claves en camelCase de cara al frontend aunque la columna sea
snake_case; nunca exponer paths de storage crudos, siempre el accessor
`_url`; usar `?->` para relaciones opcionales.

## Patrón: local scope `active()`

Todo modelo con columna `is_active` define el scope en vez de repetir el
`where` en cada controller:

```php
public function scopeActive($query)
{
    return $query->where('is_active', true);
}
```

Uso: `Category::active()->get()`, `Product::active()->where('slug', $slug)->firstOrFail()`.
Nunca `->where('is_active', true)` inline en un controller nuevo — si un
modelo tiene esa columna, el scope va en el modelo.

## Patrón: Models

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class <Entity> extends Model
{
    use HasFactory;

    protected $fillable = [/* explícito, nunca $guarded = [] */];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function <relacion>()
    {
        return $this-><belongsTo|hasMany>(<Related>::class);
    }

    public function get<Campo>UrlAttribute(): ?string
    {
        if (!$this-><campo>_path) return null;
        return Storage::disk('images')->url($this-><campo>_path);
    }
}
```

## Patrón: manejo de archivos/imágenes

> Nota histórica: en `aca-ganaderia-backend` este patrón estaba copiado a mano
> en ~10 controllers (hasFile → hashName → storeAs → borrar el anterior). A
> partir del próximo proyecto se centraliza en un trait + observer para que el
> borrado del archivo viejo no dependa de que cada controller se acuerde de
> hacerlo.

Trait reutilizable en los modelos que manejan archivos:

```php
namespace App\Models\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasImageUpload
{
    protected static function bootHasImageUpload(): void
    {
        // Borra el/los archivo(s) físico(s) al borrar el registro
        static::deleting(function ($model) {
            foreach (array_keys($model->imageFields()) as $field) {
                if ($model->{$field}) {
                    Storage::disk('images')->delete($model->{$field});
                }
            }
        });
    }

    /**
     * Mapa campo => directorio de storage. Cada modelo lo define.
     * Ej: ['icon_path' => 'categories']
     */
    abstract public function imageFields(): array;

    public function syncImage(?UploadedFile $file, string $field): void
    {
        if (!$file) {
            return;
        }

        if ($this->{$field}) {
            Storage::disk('images')->delete($this->{$field});
        }

        $directory = $this->imageFields()[$field];
        $filename = $file->hashName();
        $file->storeAs($directory, $filename, 'images');

        $this->{$field} = $directory . '/' . $filename;
    }
}
```

Uso en el modelo:

```php
class Category extends Model
{
    use HasFactory, HasImageUpload;

    public function imageFields(): array
    {
        return ['icon_path' => 'categories'];
    }
}
```

Uso en el controller (reemplaza el bloque de 15 líneas de antes):

```php
public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
{
    $category->fill($request->validated());
    $category->syncImage($request->file('icon'), 'icon_path');
    $category->save();

    return redirect()->route('admin.configuration.index')->with('status', 'Categoría actualizada.');
}
```

Disk custom `images` en `config/filesystems.php` (root `storage/app/public`,
visibility `public`, url configurable por `FILES_URL` env). Todo upload pasa
por este disk, nunca por `local`/`public` default directamente.

## Patrón: autenticación

- **Admin/web**: Breeze estándar + middleware `admin` (alias registrado en
  `bootstrap/app.php`) que valida `$request->user()->is_admin` (403 si no,
  401 si no hay user). Ojo: el mismo chequeo de `is_admin` se repite también
  dentro de cada FormRequest (`authorize()`), es intencional (defensa en
  profundidad), no lo saques de uno pensando que es redundante.
- **API**: Sanctum con token simple. Endpoints: `POST /auth/login`,
  `POST /auth/logout`, `POST /auth/logout-all`, `GET /auth/me`. Login valida
  inline con `$request->validate([...])` (no amerita FormRequest), compara con
  `Hash::check`, y lanza `ValidationException::withMessages` en español si
  falla.
  - **Abilities en vez de expiración**: el token que consume el frontend
    (Next.js) vive en una env var *server-side*, nunca llega al browser del
    usuario final — es más un API key que una sesión de usuario, así que
    expiración/refresh no aporta nada acá. Lo que sí se limita son las
    **abilities** del token, al mínimo que necesita ese consumidor:
    ```php
    $token = $user->createToken('api-token', ['read'])->plainTextToken;
    // en el endpoint que sí escribe (ej. ApiContactFormController@store):
    if (!$request->user()->tokenCan('read') && !$request->user()->tokenCan('contact:write')) {
        abort(403);
    }
    ```
    Regla: si un token se filtra, que como mucho pueda leer — nunca dar
    ability de escritura salvo al endpoint puntual que la necesita.

## Migraciones

- Una tabla por archivo `create_<tabla>_table`, alters posteriores en
  archivos separados `add_<campo>_to_<tabla>_table` (nunca editar una
  migración ya corrida en producción).
- `$table->foreignId('x_id')->constrained()->cascadeOnDelete()` como default
  para FKs.
- Siempre `$table->timestamps()`.
- Nombres de tabla en snake_case plural, igual que Laravel estándar.

## Jobs

- `implements ShouldQueue` + `Dispatchable, InteractsWithQueue, Queueable, SerializesModels`.
- Log abundante en español (`Log::info/warning/error`) describiendo qué está
  pasando, en primera persona del proceso ("Procesando N formularios...").
- Loop sobre ítems pendientes con `try/catch` **por ítem**, para que un
  fallo individual no tumbe el resto del batch.

## Calidad: PHPStan/Larastan + CI

Desde el próximo proyecto se suma (no aplica retroactivamente a
`aca-ganaderia-backend`):

- `larastan/larastan` como dev dependency, `phpstan.neon` en nivel 5 para
  empezar (subir de nivel más adelante si molesta poco).
- Workflow en `.github/workflows/ci.yml` que en cada push/PR corre:
  `composer install` → `vendor/bin/phpstan analyse` → `php artisan test`.
- Sirve para agarrar errores de tipos, null-safety y usos incorrectos de
  Eloquent (relaciones que no existen, etc.) antes de que lleguen a
  producción — no reemplaza los tests, los complementa.

## Tests: mínimo por recurso

Desde el próximo proyecto, cada recurso nuevo nace con al menos:

- Un Feature test de happy path por acción de `Api<Entity>Controller`
  (`index` devuelve 200 y solo activos, `show` devuelve el esperado).
- Un Feature test por acción de escritura del CRUD de Admin (`store`
  crea el registro, y que un usuario no-admin no pueda pegarle).

Ejemplo de referencia:

```php
public function test_categories_index_returns_only_active(): void
{
    Category::factory()->create(['is_active' => true]);
    Category::factory()->create(['is_active' => false]);

    Sanctum::actingAs(User::factory()->create(), ['read']);

    $this->getJson('/api/categories')
        ->assertOk()
        ->assertJsonCount(1, 'data');
}
```

No hace falta cobertura exhaustiva desde el día uno: con el happy path de
cada endpoint ya hay una red mínima que avisa si algo se rompe.

## Checklist: agregar un recurso nuevo completo (admin + api)

1. Migración `create_<tabla>_table` (+ seeder si necesita datos iniciales).
2. Modelo en `app/Models/<Entity>.php` con `$fillable`, `$casts`, relaciones,
   accessors `_url` si tiene archivos.
3. Si tiene pantalla de admin:
   - `Store<Entity>Request` y `Update<Entity>Request` en
     `Requests/Admin/<Area>/<Entities>/`.
   - `<Entity>Controller` en `Controllers/Admin/<Area>/` con
     `store`/`update`/`destroy` (el `index` vive en el hub de la sección, no
     acá, salvo que el recurso sea el hub).
   - Rutas en `web.php` dentro del `Route::prefix('admin')->name('admin.')`,
     agrupadas bajo el comentario `// BLOQUE <NOMBRE>`.
4. Si se expone públicamente:
   - `<Entity>Resource` en `Http/Resources/`.
   - `Api<Entity>Controller` en `Controllers/Api/` con `index`/`show`
     filtrando `is_active`.
   - Rutas en `api.php` dentro del grupo `auth:sanctum`, con comentario en
     español arriba.
5. Mensajes de usuario y logs en español; nombres de clases/variables/rutas
   `name()` en inglés; paths de rutas admin en español.
6. Feature test de happy path por cada acción nueva (Api y Admin) — ver
   sección "Tests" arriba.

## Decisiones explícitas (por ahora)

- **Sin sistema de roles/permissions** (nada de `spatie/laravel-permission`):
  mientras el único distingo sea admin/no-admin, un boolean `is_admin` +
  el middleware `admin` alcanza. Si en algún momento aparece un tercer rol,
  ahí sí se evalúa migrar a un paquete de roles — no antes.

## Notas para un proyecto nuevo desde cero

Cuando se arranca un proyecto nuevo replicando este estilo:
- Instalar Breeze (Blade) para admin + Sanctum para API desde el inicio.
- Registrar el alias `admin` en `bootstrap/app.php` **y aplicarlo al grupo de
  rutas admin** (`->middleware(['auth', 'admin'])`) — en
  `aca-ganaderia-backend` el alias se registró pero nunca se aplicó al grupo
  de rutas, quedando solo el chequeo `is_admin` en cada FormRequest como
  única barrera para las acciones de escritura, y sin ninguna barrera extra
  para las vistas de solo lectura del panel. No repetir ese descuido.
- Configurar el disk `images` en `config/filesystems.php` desde el
  arranque si el proyecto va a manejar uploads, y usar el trait
  `HasImageUpload` desde el primer modelo con archivos (ver patrón arriba).
- Definir `scopeActive()` en todo modelo con columna `is_active` desde que
  se crea el modelo, no agregarlo después.
- Sumar `larastan/larastan` + workflow de CI desde el primer commit (ver
  sección "Calidad" arriba).
- Tokens de Sanctum con abilities acotadas (`['read']` por defecto), nunca
  sin restricción.
- Al menos un Feature test de happy path por endpoint nuevo, desde el
  primero que se escriba.
- Mantener siempre la separación `Controllers/Admin/<Area>/...` vs
  `Controllers/Api/Api...Controller` — no compartir controllers entre las
  dos caras aunque el CRUD sea idéntico.
