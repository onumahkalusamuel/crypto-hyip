function ajaxPost(elementId = 'form') {
    var form = document.getElementById(elementId);
    var formData = JSON.stringify(Object.fromEntries(new FormData(form)));

    // create overlay
    var overlay = document.createElement('div');
    overlay.innerHTML = '<div style="display:table;width:100%;height:100vh;position:fixed;top:0;left:0;text-align:center;background-color:#fff5;z-index:1000"><div style="display:table-cell;vertical-align:middle;padding-bottom:100px"><span style="color:white;background-color:#333;padding:10px;">please wait...</span></div></div>';

    document.body.appendChild(overlay);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState !== 4) return;
        try {
            var response = JSON.parse(xhr.response);
            alert(response.message);
            if (response.success == true && !!response.redirect) {
                window.location.assign(response.redirect);
            }
        } catch (e) {
            alert('An error occured. Please try again later.')
        }

        document.body.removeChild(overlay);
    }

    xhr.open('POST', form.getAttribute('action'), true);
    xhr.setRequestHeader('content-type', 'application/json');
    xhr.send(formData);
    return false;
}