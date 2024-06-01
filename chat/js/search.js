const search = document.querySelector(".search");
const searchResult  = document.getElementById("searchResult");

search.onkeyup = function (){
    let searchVal = search.value;
    if (searchVal != "") {
        search.classList.add("active");
    } else {
        search.classList.remove("active");
    }
    let formData = new XMLHttpRequest();
    formData.open("POST", "php/search.php", true);
    formData.onload = () => {
        if (formData.readyState === XMLHttpRequest.DONE) {
            if (formData.status === 200) {
                let data = formData.response;
                // console.log(data);
                searchResult.innerHTML = data;
            }
        }
    }
    formData.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    formData.send("search="+searchVal);
}