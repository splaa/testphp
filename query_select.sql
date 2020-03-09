select t.ter_name, t.ter_id, t.ter_pid  from testphp.t_koatuu_tree t where t.ter_type_id=0 ;


select t.ter_name, t.ter_id, t.ter_pid  from testphp.t_koatuu_tree t where t.ter_type_id=1 and t.ter_pid='6800000000';
select t.ter_name, t.ter_id, t.ter_pid  from testphp.t_koatuu_tree t where t.ter_type_id=2 and t.ter_pid='6800000000';
select t.ter_name, t.ter_id, t.ter_pid  from testphp.t_koatuu_tree t
where ter_id = t.ter_pid;



select t.ter_name, t.ter_id, t.ter_pid  from testphp.t_koatuu_tree t where  t.ter_pid='6823900000' ;

SELECT t.*
FROM testphp.t_koatuu_tree t
WHERE ter_pid=6823900000
ORDER BY ter_mask
LIMIT 501
