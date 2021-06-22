-- 1. 
create view vHW1_1_czopikm AS
select fname AS first_name, dob AS Birthday, salary 
from CPS3740.Staff 
WHERE sex = 'F' AND (DOB >= '1970-01-01' OR DOB <= '1950-01-01');
--SENT

-- 2. 
create view vHW1_2_czopikm AS
Select fname, lname, salary 
from CPS3740.Staff 
WHERE lname like '%e' 
ORDER BY salary DESC;
--SENT

-- 3
create view vHW1_3_czopikm AS
Select count(position) AS Count, sum(salary)/count(salary) AS average_salary 
FROM CPS3740.Staff s
JOIN CPS3740.Branch b on s.branchNo = b.branchNo 
WHERE position = 'Assistant' AND city = 'London';
--SENT

-- 4
create view vHW1_4_czopikm AS
Select Hotel.hotelname AS Hotel_Name, Room.type AS Type, Room.price AS Price 
FROM CPS3740.Hotel 
JOIN CPS3740.Room 
ON Hotel.hotelno = Room.hotelno 
WHERE Room.type != 'single'
ORDER BY Room.price ASC 
LIMIT 1;
--SENT

-- 5

CREATE VIEW vHW1_5_czopikm AS
Select s.fname AS First_Name, s.position, 
m.fname AS Manager_First_Name, m.position AS Manager_Position
from CPS3740.Staff s
JOIN CPS3740.Staff m
ON s.managerNo = m.staffNo
WHERE s.position = 'Assistant' AND s.sex = 'F';
--SENT

--6 
create view vHW1_6_czopikm AS
select city AS City, count(*) AS Count 
from CPS3740.Staff s, CPS3740.Branch b 
where b.branchno=s.branchno AND sex = 'F' 
group by b.branchno 
having count(*) = 1;
--SENT


--7

CREATE view vHW1_7_czopikm AS

select s.branchNo, b.city, fname AS first_name, lname AS last_name, salary
from CPS3740.Staff s, CPS3740.Branch b 
WHERE s.branchNo = b.branchNo AND salary = (SELECT max(salary))
GROUP BY b.branchNo
ORDER BY b.branchno asc;
--DONE, minus one salary indifference.

--8
-- Guest, Hotel, Booking, Room

CREATE VIEW vHW1_8_czopikm AS 

SELECT b.guestname AS Guest_Name, c.hotelname AS Hotel_Name, 
datediff(dateto, datefrom) AS Num_of_days, 
d.price*datediff(dateto, datefrom) AS amount_due
FROM CPS3740.Booking a, CPS3740.Guest b, 
CPS3740.Hotel c, CPS3740.Room d 
WHERE a.hotelno=c.hotelno AND a.guestno=b.guestno 
AND a.roomno=d.roomno 
AND dateto IS NOT NULL
AND a.hotelno=d.hotelno 
ORDER BY amount_due ASC;
-- SENT

--9
create view vHW1_9_czopikm AS
create table Money_czopikm (

mid int NOT NULL auto_increment, 
code varchar(50) NOT NULL unique, 
cid int NOT NULL, 
sid int NOT NULL,
type char(1) NOT NULL,
amount float(10,2) NOT NULL,
mydatetime datetime NOT NULL,
note varchar(255),
PRIMARY KEY (mid),
FOREIGN KEY (cid) REFERENCES CPS3740.Customers(id),
FOREIGN KEY (sid) REFERENCES CPS3740.Sources(id)
);
-- SENT

--10

create view vHW1_10_czopikm AS
INSERT into Money_czopikm (code, cid, sid, type, amount, mydatetime, note)
VALUES
('xy004', 3, 4, 'D', 900.00, now(), 'Manually Inserted');

--SENT




 


