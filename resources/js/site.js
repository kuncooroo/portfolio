const links = [...document.querySelectorAll("[data-nav]")];
const sections = ["about", "skills", "experience", "projects", "certificates"]
  .map((id) => document.getElementById(id))
  .filter(Boolean);

const setActive = (id) => {
  links.forEach((link) => link.classList.toggle("is-active", link.dataset.nav === id));
};

const currentSection = () => {
  const marker = window.scrollY + Math.min(window.innerHeight * 0.35, 220);
  let current = sections[0]?.id;

  sections.forEach((section) => {
    const top = section.getBoundingClientRect().top + window.scrollY;
    if (top <= marker) current = section.id;
  });

  const nearBottom = window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 8;
  if (nearBottom) current = sections[sections.length - 1]?.id;

  return current;
};

const updateNav = () => {
  const id = currentSection();
  if (id) setActive(id);
};

updateNav();
window.addEventListener("scroll", updateNav, { passive: true });

const buttons = [...document.querySelectorAll("[data-filter]")];
const skills = [...document.querySelectorAll("[data-skill]")];

buttons.forEach((button) => {
  button.addEventListener("click", () => {
    const filter = button.dataset.filter;
    buttons.forEach((item) => item.classList.toggle("is-on", item === button));
    skills.forEach((skill) => {
      const show = filter === "all" || skill.dataset.skill === filter;
      skill.hidden = !show;
    });
  });
});
