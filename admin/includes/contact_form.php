<?php
// Get all messages from contact form
$messages = new Contact();
$contactMessages = $messages->getContactFormSubmissions();
?>


<div class="table-responsive">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button id="deleteSelectedBtn" class="btn btn-danger btn-rounded-pill my-2 ">Delete Selected Messages</button>

        <!-- Dummy Data Button -->
        <form action="<?php echo base_url('admin/create-dummy-messages.php') ?>" method="post" class="d-flex align-items-center">
            <label class="form-label me-2" for="messageCount">Number of Messages:</label>
            <input style="width: 100px" type="number" name="messageCount" id="messageCount" class="form-control me-2" value="" min="1" max="100">
            <button id="messageCount" class="btn btn-primary btn-rounded-pill" type="submit">Generate Dummy Messages</button>
        </form>

        <form action="<?php echo base_url('reorder-articles.php') ?>" method="post" class="">
            <button name="reorder_articles" class="btn btn-warning btn-rounded-pill" type="submit">Reoder Article ID's</button>
        </form>
    </div>
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
            <?php if ($contactMessages): ?>
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
                            <form onsubmit="confirmDeleteMessage(<?php echo $contactMessage->id; ?>)" method="post" action="<?php echo base_url("admin/delete-message.php"); ?>">
                                <input type="hidden" name="message_id" value="<?php echo $contactMessage->id; ?>">

                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php endif; ?>
        </tbody>
    </table>

</div>