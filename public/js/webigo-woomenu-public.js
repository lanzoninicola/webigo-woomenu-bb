(function (d) {
  "use strict";

  const catMenuItems = d.querySelectorAll(
    ".product-cats-nav-menu li.product-cat"
  );
  const subCatMenuWrappers = d.querySelectorAll(
    ".product-cats-nav-menu li.product-cat .product-subcats"
  );

  let catIdTargeted = false; // int
  let subcatIdTargeted = false; // int
  let subcatElTargeted = false; // element object
  let subcatElTargetedVisibilityStatus = "hidden"; // hidden ,  shown

  catMenuItems.forEach((item) => {
    item.addEventListener("mouseover", showSubMenu);
  });

  subCatMenuWrappers.forEach((item) => {
    item.addEventListener("mouseleave", hideSubMenu);
  });

  function showSubMenu() {
    const el = this;

    if (subcatElTargeted) {
      hideSubMenu();
    }

    catIdTargeted = el.getAttribute("data-product-cat");
    subcatIdTargeted = catIdTargeted;
    subCatMenuWrappers.forEach((subCatItem) => {
      if (subCatItem.getAttribute("data-product-cat") == subcatIdTargeted) {
        subcatElTargeted = subCatItem;
      }
    });
    subcatElTargetedVisibilityStatus = "shown";

    if (subcatElTargetedVisibilityStatus === "shown" && subcatElTargeted) {
      subcatElTargeted.setAttribute("data-visibility", "shown");
    }
  }

  function hideSubMenu() {
    if (subcatElTargeted) {
      subcatElTargeted.setAttribute("data-visibility", "hidden");
    }
  }

  // mobile menu management
  const navMenuMobile = d.querySelectorAll(".product-cats-nav-menu")[0];
  const closeMobileMenuButton = d.querySelectorAll(
    ".product-cats-nav-menu .ion-md-close"
  )[0];
  const openMobileMenuButton = d.getElementById("hamburger-mobile-menu");

  if (closeMobileMenuButton) {
    closeMobileMenuButton.addEventListener("click", hideMobileMenu);
  }

  if (openMobileMenuButton) {
    openMobileMenuButton.addEventListener("click", showMobileMenu);
  }

  function showMobileMenu() {
    if (navMenuMobile) {
      navMenuMobile.setAttribute("data-mobile-visibility", "shown");
    }

    if (closeMobileMenuButton) {
      closeMobileMenuButton.setAttribute("data-mobile-visibility", "shown");
    }
  }

  function hideMobileMenu() {
    if (navMenuMobile) {
      navMenuMobile.setAttribute("data-mobile-visibility", "hidden");
    }
  }
})(document);
