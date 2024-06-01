const form = document.querySelector('form');
const submitBtn = document.querySelector('#submitBtn');
const error = document.querySelector("#error");
submitBtn.onclick = function (e) {
    e.preventDefault();

    let formData = new XMLHttpRequest();
    formData.open("POST", "php/login.php", true);
    formData.onload = () => {
        if (formData.readyState === XMLHttpRequest.DONE) {
            if (formData.status === 200) {
                let data = formData.response;
                // console.log(data);
                if (data == 'success') {
                    location.href = "index.php";
                } else {
                    error.innerHTML = data;
                    error.style.display = "block";
                }
            }
        }
    }
    let sendData = new FormData(form);
    formData.send(sendData);
}