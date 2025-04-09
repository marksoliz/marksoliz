<?php
// Get all messages from contact form
$messages = new Contact();
$contactMessages = $messages->getContactFormSubmissions();
?>

<?php if ($contactMessages): ?>
    <div class="table-responsive">
        <button id="deleteSelectedBtn" class="btn btn-danger btn-rounded-pill my-2 ">Delete Selected Messages</button>
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>
                        <input type="checkbox" id="selectAllCheckbox" />
                    </th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactMessages as $contactMessage): ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="messageCheckbox" value="<?= htmlspecialchars($contactMessage->id) ?>" />
                        </td>
                        <td><?= htmlspecialchars($contactMessage->id) ?></td>
                        <td><?= htmlspecialchars($contactMessage->name) ?></td>
                        <td><?= htmlspecialchars($contactMessage->email) ?></td>
                        <td><?= htmlspecialchars($contactMessage->subject) ?></td>
                        <td><?= htmlspecialchars($contactMessage->message) ?></td>
                        <td><?= htmlspecialchars($contactMessage->created_at) ?></td>
                        <td>
                            <form onsubmit="confirmDelete(<?php echo $contactMessage->id; ?>)" method="post" action="<?php echo base_url("admin/delete-message.php"); ?>">
                                <input type="hidden" name="message_id" value="<?php echo $contactMessage->id; ?>">
                                <button class="btn btn-danger delete-single" data-id="<?= htmlspecialchars($contactMessage->id) ?>">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
<?php else: ?>
    <p>No messages found.</p>
<?php endif; ?>