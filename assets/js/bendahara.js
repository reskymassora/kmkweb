// script input transaksi baru
// script input transaksi baru
document.getElementById('debit').addEventListener('input', function() {
  var debitValue = this.value.trim(); // Menghapus spasi yang tidak diperlukan
  var kreditField = document.getElementById('kredit');

  if (debitValue !== "") {
      kreditField.disabled = true;
  } else {
      kreditField.disabled = false;
  }
});

document.getElementById('kredit').addEventListener('input', function() {
  var kreditValue = this.value.trim(); // Menghapus spasi yang tidak diperlukan
  var debitField = document.getElementById('debit');

  if (kreditValue !== "") {
      debitField.disabled = true;
  } else {
      debitField.disabled = false;
  }
});

