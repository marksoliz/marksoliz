<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2023</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- </div> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>


<script>
    function confirmDeleteMessage(messageId) {
        if (confirm('Are you sure you want to delete this message?')) {
            alert('Message ID ' + messageId + ' deleted.');
            return true; // Proceed with the deletion

        } else {
            return false; // Cancel the deletion
        }
    };

    // Select / Deselect all checkboxes
    document.getElementById('selectAllCheckbox').onclick = function() {
        let checkboxes = document.querySelectorAll('.messageCheckbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };


    // Delete selected messages
    document.getElementById('deleteSelectedBtn').onclick = function() {
        let selectIDs = [];
        let checkboxes = document.querySelectorAll('.messageCheckbox:checked');

        checkboxes.forEach((checkbox) => {
            selectIDs.push(checkbox.value);
        });

        if (selectIDs.length === 0) {
            alert("Please select at least one message to delete.");
            return;
        }

        if (confirm("Are you sure you want to delete the selected messages?")) {
            sendDeleteRequest(selectIDs);
        }
    };

    // Function to send delete using ajax
    function sendDeleteRequest(messageIds) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo base_url('admin/delete-selected-messages.php'); ?>", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the server
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert("Messages deleted successfully!");
                    location.reload(); // Reload the page to see the changes
                } else {
                    alert("Error deleting articles: " + response.message);
                }
            }
        };
        xhr.send(JSON.stringify({
            message_ids: messageIds
        }));
    };




    // Confirm delete user
    function confirmDeleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            alert('User ID ' + userId + ' deleted.');
            return true; // Proceed with the deletion
        } else {
            return false; // Cancel the deletion
        }
    };
</script>

<script>
    function confirmDeleteCategory(catID) {
        if (confirm('Are you sure you want to delete this category?')) {
            alert('Category ID ' + catID + ' deleted.');
            return true; // Proceed with the deletion

        } else {
            return false; // Cancel the deletion
        }
    };
</script>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Popper.js and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>



<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            placeholder: 'Write your blog post here...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['codeblock', 'link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            styleTags: [
                'p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ],
            fontNames: ['Arial', 'Courier New', 'Times New Roman', 'Verdana', 'Tahoma'],
            fontSizes: ['8', '10', '12', '14', '16', '18', '24', '36', '48'],
            buttons: {
                codeblock: function(context) {
                    const ui = $.summernote.ui;
                    const button = ui.button({
                        contents: '<i class="note-icon-code"/> Code Block',
                        tooltip: 'Insert <pre><code> block',
                        click: function() {
                            const range = context.invoke('editor.createRange');
                            const text = range.toString();
                            if (text.length > 0) {
                                context.invoke('editor.insertText', `<pre><code>${text}</code></pre>`);
                            } else {
                                context.invoke('editor.insertText', `<pre><code>// your code here</code></pre>`);
                            }
                        }
                    });
                    return button.render();
                }
            }
        });
    });
</script>


</body>

</html>