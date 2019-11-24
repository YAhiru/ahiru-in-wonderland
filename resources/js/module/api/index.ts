export const post = async <T>(url: string): Promise<T> => {
  return new Promise(resolve => {
    fetch("http://localhost:8080" + url, {
      method: "POST",
      mode: "cors"
    })
      .then(response => response.json())
      .then(body => {
        resolve(body);
      });
  });
};
