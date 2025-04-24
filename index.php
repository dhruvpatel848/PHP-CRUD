<!DOCTYPE html>
<html>
  <head>
    <title>CRUD</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <!-- (A) SEARCH JAVASCRIPT -->
    <script>
    function doSearch () {
      var data = new FormData(document.getElementById("mySearch"));
      fetch("controller.php", { method:"POST", body:data })
      .then(res => res.json())
      .then(res => {
        let resultsDelete = document.getElementById("resultsDelete");
        let resultsUpdate = document.getElementById("resultsUpdate");
        resultsDelete.innerHTML = "";
        resultsUpdate.innerHTML = "";
        if (res !== null) {
          for (let r of res) {
            resultsDelete.innerHTML += `<div>${r.id} - ${r.name}</div><input type='checkbox' name='delete[]' value='${r.id}'>`;
            resultsUpdate.innerHTML += `<div>${r.id} - <input type='text' name='update[${r.id}]' value='${r.name}'></div>`;
          }
        }
        resultsDelete.innerHTML += "<input type='submit' name='deleteUsers' value='Delete Selected'>";
        resultsUpdate.innerHTML += "<input type='submit' name='updateUsers' value='Update Selected'>";
      });
      return false;
    }
    </script>
    
    <!-- (B) SEARCH FORM -->
    <div>
      <h1>Search Entry</h1>
    <form id="mySearch" onsubmit="return doSearch()">
      <input type="text" name="search" required>
      <input type="submit" value="Search">
    </form>

    <!-- (C) Insert NEW USER FORM -->
    <h1>Insert Entry</h1>
    <form id="insertForm" method="post" action="insert.php">
      <input type="text" name="newID" placeholder="New User ID" required>
      <input type="text" name="newName" placeholder="New User Name" required>
      <input type="submit" name="insertUsers" value="Insert New User">
    </form>

    <!-- (D) Delete RESULTS -->
    <h1>Delete Entry</h1>
    <form method="post" action="delete.php">
      <div id="resultsDelete"></div>
    </form>

    <!-- (E) Update RESULTS -->
    <h1>Update Entry</h1>
    <form method="post" action="update.php">
      <div id="resultsUpdate"></div>
    </form>
    </div>
  </body>
</html>
