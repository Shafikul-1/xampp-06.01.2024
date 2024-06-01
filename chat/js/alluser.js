const contact = document.querySelector(".contact");

setInterval(() => {
    let formData = new XMLHttpRequest();
    formData.open("GET", "php/users.php", true);
    formData.onload = () => {
        if (formData.readyState === XMLHttpRequest.DONE) {
            if (formData.status === 200) {
                let data = formData.response;
                // console.log(data);
                const search = document.querySelector(".search");
                if (!search.classList.contains("active")) {
                    contact.innerHTML = data;
                }
            }
        }
    }
    formData.send();
}, 500);



