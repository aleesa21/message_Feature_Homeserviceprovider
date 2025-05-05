document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("service-type-container");

    function addServiceInput() {
        let div = document.createElement("div");
        div.classList.add("service-input");
        div.innerHTML = `
            <input type="text" name="service_type[]" placeholder="Enter service type">
            <button type="button" class="add-service">+</button>
            <button type="button" class="remove-service">-</button>
        `;
        container.appendChild(div);
    }

    function updateUI() {
        let serviceInputs = document.querySelectorAll(".service-input");

        if (serviceInputs.length === 0) {
            addServiceInput(); // Ensure at least one input remains
        }
    }

    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("add-service")) {
            addServiceInput();
        }

        if (event.target.classList.contains("remove-service")) {
            event.target.parentElement.remove();
            updateUI();
        }
    });

    updateUI();
});
