# Database Example

table `radgroupcheck`
```
INSERT INTO `radgroupcheck` (`id`, `groupname`, `attribute`, `op`, `value`)  
VALUES  
(1, 'user', 'Max-Monthly-Traffic', ':=', '30720'),
(2, 'user', 'Simultaneous-Use', ':=', '1'),
(3, 'user', 'Max-Daily-Traffic', ':=', '2048'),
(4, 'VIP', 'Simultaneous-Use', ':=', '7'),
(5, 'VIP', 'Max-Monthly-Traffic', ':=', '102400'),
(6, 'VIP', 'Max-Daily-Traffic', ':=', '20480');
```
table `radgroupreply`
```
INSERT INTO `radgroupreply` (`id`, `groupname`, `attribute`, `op`, `value`)  
VALUES  
(1, 'user', 'Acct-Interim-Interval', ':=', '600'),
(2, 'user', 'Idle-Timeout', ':=', '600'),
(3, 'user', 'Session-Timeout', ':=', '86400'),
(4, 'VIP', 'Acct-Interim-Interval', ':=', '3600'),
(5, 'VIP', 'Idle-Timeout', ':=', '3600'),
(6, 'VIP', 'Session-Timeout', ':=', '86400');
```