const $content = document.getElementById('texto'),
    $btn = document.getElementById('btn');

$btn.addEventListener('click', e => {
    $content.select();
    document.execCommand('copy');
})