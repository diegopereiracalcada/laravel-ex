const UPDATE_PREVENTIVA_URL = "/api/clientes/2/updatePreventiva";

function sendPut(url, content){
  return sendRequest(url, content, "put")
}

function sendPost(url, content){
  return sendRequest(url, content, "post")
}

function sendRequest(url, content, method){
  return new Promise(resolve => {
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
          console.log("Retornada resposta da requisição... ", response.text)
          resolve();
        } else {
          alert(response.statusText);
        }
      })
  });

    
}

export default {
  putPreventiva(preventiva){
    console.log("putPreventiva...", preventiva);
    return sendPut(UPDATE_PREVENTIVA_URL, {'preventiva':preventiva})
  }
}