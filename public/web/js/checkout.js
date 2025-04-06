
function openModal() {
    document.getElementById('addressModal').classList.add('open');
}

function closeModal() {
    document.getElementById('addressModal').classList.remove('open');
}
function openaddModal(){
    closeModal(); // Close any open modal before opening a new one
    document.getElementById("addressaddModal").classList.add("open");

}
