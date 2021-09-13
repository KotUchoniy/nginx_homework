<?php
  $host = '192.168.7.161'; // ад�.е�. �.е�.ве�.а
  $db_name = 'otus_db'; // им�. баз�. данн�.�.
  $user = 'otus'; // им�. пол�.зова�.ел�.
  $password = 'student'; // па�.ол�.

  echo "Server Address: ";
  echo  $_SERVER['SERVER_ADDR'];
  echo "<br />\n";
  echo "<br />\n";

 # Создаем �оединение � базой PostgreSQL � �казанн�ми в��е па�аме��ами
 $dbconn = pg_connect("host=$host port=5432 dbname=$db_name user=$user password=$password");

  if (!$dbconn) {
  die('Could not connect');
  }
  else {
  echo ("Connected to Database");
  echo "<br />\n";
  # ��полн�ем зап�о� на �оздание �абли�� testtable

   $sql = "CREATE TABLE IF NOT EXISTS testtable (
   id serial PRIMARY KEY,
   number character varying(20) NOT NULL UNIQUE,
   name character varying(20) NOT NULL,
   kol character varying(20) NOT NULL
   )";

    $res = pg_query($sql);
    # Сделаем зап�о� на пол��ение �пи�ка �озданн�� �абли�
    $res = pg_query($dbconn, "select table_name, column_name from information_schema.columns where table_schema='public'");
    if (!$res) {
    echo "��оизо�ла о�ибка.\n";
    }
    # ��ведем �пи�ок �абли� и ��олб�ов в каждой �абли�е

     while ($row = pg_fetch_row($res)) {
     echo "tableName: $row[0] ColumnName: $row[1]";
     echo "<br />\n";
     }

      # �обавим в �озданн�� �абли�� две ���о�ки

       $res = pg_query($dbconn, "INSERT INTO testtable (id,number,name,kol) VALUES(1,'2','Name1','4')");
       $res = pg_query($dbconn, "INSERT INTO testtable (id,number,name,kol) VALUES(2,'3','Name2','4')");
       $res = pg_query($dbconn, "INSERT INTO testtable (id,number,name,kol) VALUES(3,'4','Name3','4')");

        # Сделаем зап�о� на пол��ение ���ок � id=2
        $res = pg_query($dbconn, "select name, kol from testtable where id=2");

         # ��ведем пол��енн�е ���оки
         while ($row = pg_fetch_row($res)) {
         echo "Name: $row[0] Kol: $row[1]";
         echo "<br />\n";
         }
         }
         ?>