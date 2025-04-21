
const passportUpload = document.querySelector('.passport-upload');
const passportInput = document.getElementById('passport');

passportUpload.addEventListener('click', () => {
    passportInput.click();
});

passportInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (file) {
       
        if (file.size > 5 * 1024 * 1024) {
            alert('File size exceeds 5MB limit. Please choose a smaller file.');
            return;
        }

  
        const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!validTypes.includes(file.type)) {
            alert('Invalid file type. Please upload JPG, PNG, or PDF files only.');
            return;
        }

        const fileName = file.name;
        passportUpload.querySelector('p').textContent = `Selected: ${fileName}`;
        passportUpload.classList.add('has-file');
    }
});


const paymentMethods = document.querySelectorAll('.payment-method');

paymentMethods.forEach(method => {
    method.addEventListener('click', () => {
        paymentMethods.forEach(m => m.classList.remove('active'));
        method.classList.add('active');
    });
});

document.addEventListener('DOMContentLoaded', function() {

    const tabButtons = document.querySelectorAll('.tab-btn');
    const bookingForms = document.querySelectorAll('.booking-form');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
    
            tabButtons.forEach(btn => btn.classList.remove('active'));
            bookingForms.forEach(form => form.classList.remove('active'));

      
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            const activeForm = document.querySelector(`.${tabId}-form`);
            
            if (activeForm) {
                activeForm.classList.add('active');
            }
        });
    });

    const tripTypeRadios = document.querySelectorAll('input[name="trip-type"]');
    const returnDateGroup = document.querySelector('.return-date');

    tripTypeRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.value === 'one-way') {
                returnDateGroup.style.display = 'none';
            } else {
                returnDateGroup.style.display = 'flex';
            }
        });
    });


    const counterBtns = document.querySelectorAll('.counter-btn');
    counterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const counter = this.parentElement;
            const countDisplay = counter.querySelector('.count');
            let count = parseInt(countDisplay.textContent);
            
            if (this.classList.contains('plus')) {
                count++;
            } else if (this.classList.contains('minus') && count > 0) {
                count--;
            }
            
            countDisplay.textContent = count;
        });
    });

    
    const cabinOptions = document.querySelectorAll('.cabin-option');
    cabinOptions.forEach(option => {
        option.addEventListener('click', function() {
            cabinOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
        });
    });


    const carOptions = document.querySelectorAll('.car-option');
    carOptions.forEach(option => {
        option.addEventListener('click', function() {
            carOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    const starOptions = document.querySelectorAll('.star-option');
    starOptions.forEach(option => {
        option.addEventListener('click', function() {
            starOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    const dateInputs = document.querySelectorAll('.date-input');
    dateInputs.forEach(input => {
        input.addEventListener('change', function() {
            const today = new Date();
            const selectedDate = new Date(this.value);
            
            if (selectedDate < today) {
                alert('Please select a future date');
                this.value = '';
            }
        });
    });


    bookingForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const formValues = {};
            
            for (let [key, value] of formData.entries()) {
                formValues[key] = value;
            }
            
     
            console.log('Form submitted:', formValues);
            

            showNotification('Booking request submitted successfully!', 'success');
        });
    });

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <p>${message}</p>
            </div>
        `;
        
        document.body.appendChild(notification);
        

        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.padding = '15px 20px';
        notification.style.borderRadius = '8px';
        notification.style.backgroundColor = type === 'success' ? '#4CAF50' : '#f44336';
        notification.style.color = 'white';
        notification.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2)';
        notification.style.zIndex = '1000';
        notification.style.opacity = '0';
        notification.style.transform = 'translateY(-20px)';
        notification.style.transition = 'all 0.3s ease';
        

        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateY(0)';
        }, 10);
        

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
}); 