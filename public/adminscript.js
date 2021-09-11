function deleteRecord() {
    if (!confirm("Are you sure you want to delete this record?")) return false;
    this.click();
}

function confirmAction(message) {
    if (!confirm(message)) return false;
    this.click();
}

function logoutUser() {
    if (!confirm("Are you sure you want to logout?")) return false;
    this.click();
}

function closeAlert() {
    document.querySelector('.alert').style.display = 'none';
}