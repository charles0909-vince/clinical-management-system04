// resources/js/charts.js
import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function() {
    // Patient Statistics Chart
    const patientCtx = document.getElementById('patientStats').getContext('2d');
    new Chart(patientCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'New Patients',
                data: [12, 19, 3, 5, 2, 3],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        }
    });

    // Appointment Statistics Chart
    const appointmentCtx = document.getElementById('appointmentStats').getContext('2d');
    new Chart(appointmentCtx, {
        type: 'bar',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            datasets: [{
                label: 'Appointments',
                data: [12, 19, 3, 5, 2],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1
            }]
        }
    });
});