document.getElementById("submit").onclick = function() {
    if (document.getElementById("uploadBtn").value == "") {
        alert('Vui lòng chọn file để upload');
    }
}
document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
}