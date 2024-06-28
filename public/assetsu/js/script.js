// script.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('multiStepForm');
    const nextButtons = document.querySelectorAll('.next-step');
    const prevButtons = document.querySelectorAll('.prev-step');
    const steps = document.querySelectorAll('.form-step');

    let currentStep = 0;

    function showStep(step) {
        steps.forEach((s, index) => {
            s.classList.toggle('form-step-active', index === step);
        });
    }

    function validateStep(step) {
        const inputs = steps[step].querySelectorAll('input, select');
        let valid = true;

        inputs.forEach(input => {
            if (!input.value) {
                input.classList.add('is-invalid');
                valid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        return valid;
    }

    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            currentStep--;
            showStep(currentStep);
        });
    });

    form.addEventListener('submit', (e) => {
        if (!validateStep(currentStep)) {
            e.preventDefault();
        }
    });

    showStep(currentStep);
});
