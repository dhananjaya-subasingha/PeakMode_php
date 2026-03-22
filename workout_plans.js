document.addEventListener("DOMContentLoaded", function() {
    let cards = document.querySelectorAll(".routine-card");
    let levelRadios = document.querySelectorAll("input[name='level']");
    let categoryRadios = document.querySelectorAll("input[name='category']");
    let searchInput = document.getElementById("search");
    let button = document.querySelector(".filter_group:last-of-type button");

    function filterCards() {
        let selectedLevel = document.querySelector("input[name='level']:checked");
        let selectedCategory = document.querySelector("input[name='category']:checked");
        let searchText = searchInput.value.toLowerCase();

        cards.forEach(card => {
            let cardLevel = card.dataset.level;
            let cardCategory = card.dataset.category;
            let cardText = card.innerText.toLowerCase();

            let levelMatch = !selectedLevel || selectedLevel.value === cardLevel;
            let categoryMatch = !selectedCategory || selectedCategory.value === "all" || selectedCategory.value === cardCategory;
            let searchMatch = cardText.includes(searchText);

            card.style.display = (levelMatch && categoryMatch && searchMatch) ? "block" : "none";
        });
    }

    levelRadios.forEach(radio => radio.addEventListener("change", filterCards));
    categoryRadios.forEach(radio => radio.addEventListener("change", filterCards));
    button.addEventListener("click", filterCards);

    searchInput.addEventListener("keyup", function(e) {
        if (e.key === "Enter") filterCards();
    });
});