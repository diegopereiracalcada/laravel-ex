const UPDATE_PREVENTIVA_PREFIX_URL = "/api/clientes/";
const UPDATE_PREVENTIVA_SUFIX_URL = "/updatePreventiva";

function sendPut(url, content){
  return sendRequest(url, content, "put")
}

function sendPost(url, content){
  return sendRequest(url, content, "post")
}

function sendRequest(url, content, method){
  return new Promise((resolve, reject) => {
    fetch(url, {
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json, text-plain, */*",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": document
                          .querySelector('meta[name="csrf-token"]')
                          .getAttribute("content")
      },
      method: method,
      credentials: "same-origin",
      body: JSON.stringify(content)
    })
      .then(response => {
        if (response.ok) {
          resolve(response);
        } else {
          reject(response.statusText);
        }
      })
      .catch(error => {
        reject(error);
      })
  });

    
}

export default {
  putPreventiva(cliente){
    return sendPut(`${UPDATE_PREVENTIVA_PREFIX_URL}${cliente.id}${UPDATE_PREVENTIVA_SUFIX_URL}`, {'preventivapadrao': cliente.preventivapadrao})
  }
}