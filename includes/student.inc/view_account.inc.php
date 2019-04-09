<div class="card home-view">
    <div class="card-title">
        Account Details - <?php echo $_SESSION['userId'] ?>
    </div>
    <div class="card-body align-left">
        <p><?php echo $_SESSION['studentName'] ?></p>
        <p><?php echo $_SESSION['studentLevel'] . " " . ucfirst($_SESSION['userType']) ?></p>
    </div>
</div>

