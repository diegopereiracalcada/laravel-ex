<h2>Abertura de Chamado #{{$chamado->id}} -  <span style="color: #181880">{{$cliente->name}}</span></h2>
<p>Seu chamado foi aberto - Buscaremos uma solução e entraremos em contato.</p>

<div class="titled-info-box" style="background: #ccc;padding: 12px;">
    <h4 style="margin: 0 0.6rem 0.6rem">Solicitação inicial</h4>
    <div
        style="background:white;padding:10px;font-weight: bold;font-size: 0.9rem;"
        >{{$chamado->descricao}}</div>
</div>

<p>Aberto em {{$chamado->dt_abertura}}</p>

<p 
    style="font-style: italic"
    >Este é um email automático. Caso tenha mais alguma informação para complementar a descrição pode responder este email.</p>
