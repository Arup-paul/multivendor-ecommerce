function Notify(type, res, msg = null) {
    var background;
    var message;
    switch (type) {
        case "success":
            background = "linear-gradient(to right, rgb(0, 176, 155), rgb(150, 201, 61))";
            message = msg ?? res.message ?? 'Congratulate! Operation Successful.';
            break;
        case "error":
            background = "radial-gradient(circle at 10% 50.5%, rgb(255, 107, 6) 0%, rgb(255, 1, 107) 90%)";
            message = msg ?? res ?? 'Oops! Something went wrong';
            break;
        case "warning":
            background = "linear-gradient(135deg, rgb(252, 207, 49) 10%, rgb(245, 85, 85) 100%)";
            message = msg ?? res.message ?? res.responseJSON.message ?? 'Warning! Operation Failed.';
            break;
        default:

    }
    Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        style: {
            background: background,
        }
    }).showToast();
}
