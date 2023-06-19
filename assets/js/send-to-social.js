jQuery(document).ready(function($) {
    $(document).on('click', '.social-button', function(e) {
        e.preventDefault();
        var button = $(this); // Armazena o botão em uma variável
        var postID = $(this).data('postid');

        // Desabilita o botão
        button.prop('disabled', true);

        var data = {
            'action': 'send_to_social',
            'post_id': postID
        };
        $.post(custom_vars.ajax_url, data, function(response) {
            // Aqui você tem acesso à resposta
            if (response.success) {
                // Se a solicitação for bem-sucedida, execute alguma ação
                alert('Postagem enviada com sucesso!');
            } else {
                // Se a solicitação falhar, mostre uma mensagem de erro
                alert('Erro ao enviar postagem: ' + response.data);
            }
            // Atualize a página ou execute qualquer outra ação necessária
            location.reload();
        });
    });
});