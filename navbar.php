<!-- pages/navbar.php -->
<nav class="cabecalho">
    <a class="logo" href="/"></a>
    <button class="cabecalho__toggle" aria-label="Menu">
        ☰
    </button>
    <div class="cabecalho__icones">
        <a href="/pages/about.html" class="cabecalho__about"></a>
        <a href="/novo-video" class="cabecalho__videos"></a>
        <a href="/pages/login.html" class="cabecalho__sair"></a>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.querySelector('.cabecalho__toggle');
        const icons = document.querySelector('.cabecalho__icones');

        toggleButton.addEventListener('click', function () {
            icons.classList.toggle('active');
        });
    });
</script>