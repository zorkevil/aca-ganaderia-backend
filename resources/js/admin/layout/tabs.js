export default function initAccordionTabs(context = document) {
  context.querySelectorAll('.accordion-tabs').forEach((container) => {
    const itemCount = container.querySelectorAll('.accordion-item').length;
    container.style.setProperty('--tab-count', itemCount);
  });
}
