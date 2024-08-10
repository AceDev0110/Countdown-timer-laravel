document.addEventListener('DOMContentLoaded', () => {
    let timerInterval;
    let time = 300; // Default 5 minutes
    let remainingTime = time;
    let running = false;

    const timerElement = document.getElementById('timer');
    const startPauseButton = document.getElementById('startPauseButton');
    const resetButton = document.getElementById('resetButton');
    const settingsButton = document.getElementById('settingsButton');
    const settingsModal = document.getElementById('settingsModal');
    const saveSettingsButton = document.getElementById('saveSettingsButton');
    const closeSettingsButton = document.getElementById('closeSettingsButton');
    const timerModeDropdown = document.getElementById('timerMode');
    const predefinedTimerSelect = document.getElementById('predefinedTimerSelect');
    const customDurationInput = document.getElementById('customDuration');
    const orangeAlertInput = document.getElementById('orangeAlert');
    const redAlertInput = document.getElementById('redAlert');
    const stopAtZeroCheckbox = document.getElementById('stopAtZero');
    const predefinedTimersDiv = document.getElementById('predefinedTimers');
    const customTimerDiv = document.getElementById('customTimer');

    let orangeAlertTime = 60;
    let redAlertTime = 30;
    let stopAtZero = true;

    function updateTimerDisplay() {
        const minutes = String(Math.floor(remainingTime / 60)).padStart(2, '0');
        const seconds = String(remainingTime % 60).padStart(2, '0');
        timerElement.textContent = `${minutes}:${seconds}`;
        updateTimerColor();
    }

    function updateTimerColor() {
        if (remainingTime <= redAlertTime) {
            timerElement.classList.remove('text-yellow-600', 'text-gray-600');
            timerElement.classList.add('text-red-600');
        } else if (remainingTime <= orangeAlertTime) {
            timerElement.classList.remove('text-red-600', 'text-gray-600');
            timerElement.classList.add('text-yellow-600');
        } else {
            timerElement.classList.remove('text-red-600', 'text-yellow-600');
            timerElement.classList.add('text-gray-600');
        }
    }

    function startTimer() {
        timerInterval = setInterval(() => {
            if (remainingTime > 0) {
                remainingTime--;
            } else if (stopAtZero && remainingTime === 0) {
                pauseTimer();
            } else {
                remainingTime--;
            }
            updateTimerDisplay();
        }, 1000);
    }

    function pauseTimer() {
        clearInterval(timerInterval);
    }

    startPauseButton.addEventListener('click', () => {
        if (running) {
            pauseTimer();
            startPauseButton.textContent = 'Start';
        } else {
            startTimer();
            startPauseButton.textContent = 'Pause';
        }
        running = !running;
    });

    resetButton.addEventListener('click', () => {
        pauseTimer();
        remainingTime = time;
        updateTimerDisplay();
        startPauseButton.textContent = 'Start';
        running = false;
    });

    settingsButton.addEventListener('click', () => {
        settingsModal.classList.remove('hidden');
        // Set initial values for the modal inputs
        timerModeDropdown.value = time === 300 ? 'predefined' : 'custom';
        predefinedTimerSelect.value = String(time);
        customDurationInput.value = String(time);
        orangeAlertInput.value = String(orangeAlertTime);
        redAlertInput.value = String(redAlertTime);
        stopAtZeroCheckbox.checked = stopAtZero;
    });

    closeSettingsButton.addEventListener('click', () => {
        settingsModal.classList.add('hidden');
    });

    saveSettingsButton.addEventListener('click', () => {
        const mode = timerModeDropdown.value;
        if (mode === 'predefined') {
            time = parseInt(predefinedTimerSelect.value, 10);
        } else {
            time = parseInt(customDurationInput.value, 10) > 0 ? parseInt(customDurationInput.value, 10) : 0;
        }
        orangeAlertTime = parseInt(orangeAlertInput.value, 10) > 0 ? parseInt(orangeAlertInput.value, 10) : 0;
        redAlertTime = parseInt(redAlertInput.value, 10) > 0 ? parseInt(redAlertInput.value, 10) : 0;
        stopAtZero = stopAtZeroCheckbox.checked;
        remainingTime = time;
        updateTimerDisplay();
        settingsModal.classList.add('hidden');
    });

    timerModeDropdown.addEventListener('change', () => {
        if (timerModeDropdown.value === 'predefined') {
            predefinedTimersDiv.classList.remove('hidden');
            customTimerDiv.classList.add('hidden');
        } else {
            predefinedTimersDiv.classList.add('hidden');
            customTimerDiv.classList.remove('hidden');
        }
    });

    // Initial display setup
    updateTimerDisplay();
});
