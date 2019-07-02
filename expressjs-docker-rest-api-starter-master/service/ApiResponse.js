class ApiResponse
{
    static get SUCCESS() { return 'SUCCESS'; };
    static get ERROR() { return 'ERROR'; };

    static get DEFAULT_CONTENT_TYPE() { return 'application/json'; };

    constructor(response, status, code, data, errors = [])
    {
        this.response = response;
        this.status = status;
        this.code = code;
        this.data = data;
        this.errors = errors;
        this.contentType = ApiResponse.DEFAULT_CONTENT_TYPE;

    }

    setContentType(type)
    {
        this.contentType = type;
    }

    sendResponse()
    {
        this.response.setHeader('Content-Type', this.contentType);
        this.response.status(this.code);
        if (this.status === ApiResponse.SUCCESS) {
            return this.response.send(JSON.stringify({data: this.data}));
        } else {
            return this.response.send(JSON.stringify({errors: this.errors}));
        }
    }
}

module.exports = ApiResponse;
