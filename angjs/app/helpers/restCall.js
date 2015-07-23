function sendRequest(url, data, method, success, http, location)
{
    var req = http;
    var url = BACKEND_IP + url
    switch (method) {
        case "GET":
            req = req.get(url);
        break;
        case "POST":
            req = req.post(url, data);
        break;
        case "PUT":
            req = req.put(url, data);
        break;
        case "DELETE":
            req = req.delete(url, data);
        break;
    }
    req.success(function(result, status, headers, config) {
        if (typeof result.error !== "undefined" && result.error.type === "AUTH_NEEDED") {
            location.path("/admin-login");
        }
        success(result);
    })
    .error(function(result, status, headers, config) {
        console.log(result);
    });
}
