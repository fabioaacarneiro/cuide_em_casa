document.addEventListener("DOMContentLoaded", () => {
  fetch("/contact/get")
    .then((res) => res.json())
    .then((data) => {
      const contactDiv = document.querySelector("#contactData");
      contactDiv.innerHTML = `
        <p><strong>Nome:</strong> ${data.nome} ${data.sobrenome}</p>
        <p><strong>Idade:</strong> ${data.idade}</p>
        <p><strong>Profissão:</strong> ${data.profissao}</p>
        <p><strong>Sexo:</strong> ${data.sexo}</p>
        <p><strong>Naturalidade:</strong> ${data.naturalidade}</p>
        <p><strong>Estado Civil:</strong> ${data.estado_civil}</p>
      `;
    })
    .catch((error) => console.error("Erro ao obter dados de contato:", error));
});
