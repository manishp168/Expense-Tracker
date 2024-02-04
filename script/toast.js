function showToast(msg, time, type) {
    var toast = document.getElementById("toast-container");
    var newToast = document.createElement("div");
    newToast.className = `toast show ${type}`;
    newToast.textContent = msg;
    toast.appendChild(newToast);

    setTimeout(function(){
        newToast.classList.remove("show");
            toast.removeChild(newToast);
    }, time);
}
