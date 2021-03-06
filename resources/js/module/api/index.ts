const BASE = 'http://localhost:8080';

export const post = async <T>(url: string, params: object = {}): Promise<T> => {
  return new Promise(resolve => {
    fetch(BASE + url, {
      method: "POST",
      body: JSON.stringify(params),
      headers: {
        "Content-type": "application/json; charset=UTF-8"
      }
    })
      .then(response => response.json())
      .then(body => {
        resolve(body);
      });
  });
};

export const patch = async <T>(url: string, params: object = {}): Promise<T> => {
  return new Promise(resolve => {
    fetch(BASE + url, {
      method: "PATCH",
      body: JSON.stringify(params),
      headers: {
        "Content-type": "application/json; charset=UTF-8"
      }
    })
      .then(response => response.json())
      .then(body => {
        resolve(body);
      });
  });
};

export const get = async <T>(url: string, params: object = {}): Promise<T> => {
  return new Promise(resolve => {
    const options = Object.assign(params, {
      method: "GET"
    });
    fetch(BASE + url, options)
      .then(response => response.json())
      .then(body => {
        resolve(body);
      });
  });
};
