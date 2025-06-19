export async function fetchData(url, method = 'GET', data = null, headers = {}) {
    try {
        const options = {
            method,
            headers: {
                'Accept': 'application/json',
                ...headers
            }
        };

        if (data) {
            if (data instanceof FormData) {
                options.body = data;
            } else {
                options.headers['Content-Type'] = 'application/json';
                options.body = JSON.stringify(data);
            }
        }

        const request = await fetch(url, options);
        return await request.json();
    } catch (error) {
        console.error('API Error:', error);
        throw error;
    }
}

export function getCourseID() {
    const path = window.location.pathname;
    const parts = path.split('/');
    return parts[parts.length - 1];
}