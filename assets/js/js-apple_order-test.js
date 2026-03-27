document.addEventListener("DOMContentLoaded", function() {
            function selectCard(cards, selectedClass) {
                cards.forEach(card => {
                    card.addEventListener("click", function() {
                        cards.forEach(c => c.classList.remove(selectedClass));
                        this.classList.add(selectedClass);
                    });
                });
            }
            selectCard(document.querySelectorAll(".model-card"), "selected");
            selectCard(document.querySelectorAll(".storage-card"), "selected");
            selectCard(document.querySelectorAll(".color-circle"), "selected");
            selectCard(document.querySelectorAll(".trade-card"), "selected");
            selectCard(document.querySelectorAll(".payment-card"), "selected");
        });
