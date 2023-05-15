
    <table style="width: 100%; margin-bottom: 20mm; border: none;background-color: none">
      <tr style="border: none; background-color: none">
        <td class="td-menu">
            <a href="index.php">
                Home
            </a>
        </td>
        
        <td class="td-menu">
        <a href="skinchange.php">
          Site styles
        </a>
        </td>
        <td class="td-menu">
        <a href="search_by_strings.php">
          Search by strings
        </a>
        </td>
       
        <td style="width: 40%; border: none; background-color: none; color: none"></td>
        <?php if($_SESSION['admin']==1): ?>
          
          <td class="td-menu">
          <a href="newguitartype.php">
          New Guitar Type
          </a>
        </td>
        
        <?php endif; ?>
        <td class="td-menu">
        <a href="search_by_user.php">
          Search
          </a>
        </td>
        <form action="login.php" method="POST">
        <td class="td-menu">
          <a href="login.php">
            <button type="submit" name="logout" style="cursor: pointer">Sign out</button>
          </a>       
        </td>
      </form>
      </tr>
    </table>
    