function selectElementByClass(className) {
    return document.querySelector(`.${className}`);
}

const sections = [
    selectElementByClass("about"),
    selectElementByClass("skills"),
    selectElementByClass("portfolio"),
    selectElementByClass("contact")
];

const navItems = {
    about: selectElementByClass("aboutNavItem"),
    skills: selectElementByClass("skillsNavItem"),
    portfolio: selectElementByClass("portfolioNavItem"),
    contact: selectElementByClass("contactNavItem")
};

// intersection observer setup
const observerOptions = {
    root: null,
    rootMargin: "0px",
    threshold: 0.7
};

function observerCallback(entries, observer) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            // get the nav item corresponding to the id of the section
            // that is currently in view
            const navItem = navItems[entry.target.id];
            // add 'active' class on the navItem
            navItem.classList.add("active");
            // remove 'active' class from any navItem that is not
            // same as 'navItem' defined above
            Object.values(navItems).forEach((item) => {
                if (item != navItem) {
                    item.classList.remove("active");
                }
            });
        }
    });
}

const observer = new IntersectionObserver(observerCallback, observerOptions);

sections.forEach((sec) => observer.observe(sec));



function mobileNav() {
    var x = document.getElementById("myLinks");
    let logo = document.getElementById("logoMobile");
    if (x.style.display === "block") {
      x.style.display = "none";
      logo.style.transform = "none";
    } else {
      x.style.display = "block";    
      logo.style.transform = "rotate3d(1,1,1,-45deg) scale(130%)";  
    }

}

function closeNav() {
    var x = document.getElementById("myLinks");
    let logo = document.getElementById("logoMobile");
    
    x.style.display = "none";
    logo.style.transform = "none";

}