<?php 
// Step 1: Calculate the shortest expiration date for each medicine from the detail_stock table
$calculateShortestExpirationQuery = "SELECT medicine_id, MIN(exp_date) AS shortest_exp_date FROM detail_stock GROUP BY medicine_id";
$shortestExpirationResult = mysqli_query($con, $calculateShortestExpirationQuery);

// Step 2: Update the stock table with the calculated shortest expiration date for each medicine
while ($row = mysqli_fetch_assoc($shortestExpirationResult)) {
    $medicineId = $row['medicine_id'];
    $shortestExpDate = $row['shortest_exp_date'];

    $updateStockQuery = "UPDATE stock SET exp_date = '$shortestExpDate' WHERE medicine_id = $medicineId";
    mysqli_query($con, $updateStockQuery);
}

// Step 3: Monitor and handle medicine expiration in the detail_stock table
$currentDate = date('Y-m-d');
$handleExpiredMedicineQuery = "SELECT * FROM detail_stock WHERE exp_date <= '$currentDate'";
$expiredMedicineResult = mysqli_query($con, $handleExpiredMedicineQuery);

while ($expiredMedicineRow = mysqli_fetch_assoc($expiredMedicineResult)) {
    $medicineId = $expiredMedicineRow['medicine_id'];
    $expiredAmount = $expiredMedicineRow['amount'];

    // Reduce the amount of medicine in the stock table
    $reduceStockQuery = "UPDATE stock SET amount = amount - $expiredAmount WHERE medicine_id = $medicineId";
    mysqli_query($con, $reduceStockQuery);

    // Find the next shortest expiration date for the expired medicine
    $findNextShortestExpDateQuery = "SELECT exp_date FROM detail_stock WHERE medicine_id = $medicineId AND exp_date > '$currentDate' ORDER BY exp_date ASC LIMIT 1";
    $nextShortestExpDateResult = mysqli_query($con, $findNextShortestExpDateQuery);
    $nextShortestExpDateRow = mysqli_fetch_assoc($nextShortestExpDateResult);
    $nextShortestExpDate = $nextShortestExpDateRow['exp_date'];

    // Replace the expired medicine with the next shortest expiration date in the detail_stock table
    $replaceExpiredMedicineQuery = "UPDATE detail_stock SET exp_date = '$nextShortestExpDate' WHERE medicine_id = $medicineId AND exp_date = '$expiredMedicineRow[exp_date]'";
    mysqli_query($con, $replaceExpiredMedicineQuery);
}

?>
