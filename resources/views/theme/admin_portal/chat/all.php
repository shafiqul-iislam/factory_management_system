<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>

<div id="chat">
    <input type="text" id="message" />
    <button id="send">Send</button>
    <ul id="messages"></ul>
</div>

<?php include(resource_path('/views/theme/admin_portal/dashboard/footer.php')); ?>

<script>
    $(document).ready(function() {

        $('#send').on('click', function() {
            const message = $('#message').val();

            $.ajax({
                url: "<?php echo url('real-time-chat/send-message'); ?>", // adjust this to your route for sending messages, e.g., 'real-time-chat/send-message',
                type: 'POST',
                data: {
                    message: message,
                    _token: '<?php echo csrf_token(); ?>'
                },
                success: function(response) {
                    if (response.status) {
                        console.log('✅ Message sent!');
                        $('#message').val(''); // clear input
                    } else {
                        console.warn('⚠️ ' + response.message);
                    }
                },
                error: function(xhr) {
                    let errorMsg = '❌ Failed to send message.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = '❌ ' + xhr.responseJSON.message;
                    }
                    console.error(errorMsg);
                }
            });
        });

        Echo.private('real-time-chat')
            .listen('MessageSent', (e) => {
                $('#messages').append('<li>' + e.message + '</li>');
            });


    });
</script>