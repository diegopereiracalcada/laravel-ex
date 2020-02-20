<h2>Fechamento do Chamado #{{$chamado->id}} -  <span style="color: #181880">{{$cliente->name}}</span></h2>
<p>Seu chamado foi finalizado. Caso a solução não lhe atenda 100% nos informe pelo email atendimentochamado@gmail.com.</p>

<div class="titled-info-box" style="background:#ccc; padding:12px; margin-bottom:1rem">
    <h4 style="margin: 0 0.6rem 0.6rem">Solicitação inicial:</h4>
    <div
        style="background:white;padding:10px;font-weight: bold;font-size: 0.9rem;"
        >{{$chamado->descricao}}</div>
</div>

<div class="titled-info-box" style="background:#ccc; padding:12px; background:#6a95bf;">
    <h4 style="margin: 0 0.6rem 0.6rem">Solução aplicada:</h4>
    <div
        style="background:white;padding:10px;font-weight: bold;font-size: 0.9rem;"
        >{{$chamado->solucao}}</div>
</div>

<p>Aberto em {{$chamado->dt_abertura}}</p>

<p 
    style="font-style: italic"
    >Este é um email automático. </p>
