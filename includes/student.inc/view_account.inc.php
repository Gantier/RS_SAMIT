<div class="card">
    <div class="card-title">
        Account Details - <?php echo $_SESSION['userId'] ?>
    </div>
    <div class="card-body">
        <p><?php echo $_SESSION['studentName'] ?></p>
        <p><?php echo $_SESSION['studentLevel'] . " " . ucfirst($_SESSION['userType']) ?></p>
    </div>
</div>

