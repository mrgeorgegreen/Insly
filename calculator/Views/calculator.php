<br>
<body>
  <form action="index.php">
    <p>Calculator.</p>
    <p>Estimated value of the car (100 - 100 000 EUR): <input type=number name="value" min="100" max="100000" required><span></span></p>
    <p>Tax percentage (0 - 100%): <input type=number name="tax" min="0" max="100" ><span></span></p>
    <p>Number of instalments (count of payments in which client wants to pay for the policy (1 – 12)):
    <input type=number name="instalments" min="1" max="12" required><span></span></p>
    <input type=hidden name="nowday" id="day" >
    <input type=hidden name="nowhours" id="hours" >
   <p><input type="submit" value="Calculate"></p>

  </form>

<script>
document.getElementById('day').value = new Date().getDay();
document.getElementById('hours').value = new Date().getHours();
</script>
</body>