# Counter Example
default path `/etc/raddb/sql/mysql/counter.sql`
```
sqlcounter dailycounter {  
    counter-name = Daily-Traffic
    check-name = Max-Daily-Traffic
    reply-name = Daily-Traffic-Limit
    sqlmod-inst = sql
    key = User-Name
    reset = daily

    query = "SELECT CASE WHEN FLOOR(SUM(acctinputoctets+acctoutputoctets)/1024/1024) IS NULL THEN 0 END FROM radacct WHERE username='%{%k}' AND acctstarttime >= date_format(now(),'%Y-%m-%d 00:00:00') AND acctstoptime <= date_format(now(),'%Y-%m-%d 23:59:59')"

}


sqlcounter monthlycounter {  
    counter-name = Monthly-Traffic
        check-name = Max-Monthly-Traffic
        reply-name = Monthly-Traffic-Limit
        sqlmod-inst = sql
        key = User-Name
        reset = monthly


    query = "SELECT CASE WHEN  FLOOR(SUM(acctinputoctets+acctoutputoctets)/1024/1024) IS NULL THEN 0 END FROM radacct WHERE username='%{%k}' AND acctstarttime >= date_format(now(),'%Y-%m-01 00:00:00') AND acctstoptime <= concat(last_day(now()),' 23:59:59')"

}

sqlcounter noresetcounter {  
        counter-name = Max-All-Session-Time
                check-name = Max-All-Session
                sqlmod-inst = sql
                key = User-Name
                reset = never
        query = "SELECT IFNULL(SUM(AcctSessionTime),0) FROM radacct WHERE UserName='%{%k}'"
}
```