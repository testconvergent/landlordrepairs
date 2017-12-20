select `user_id`, `user_name`, `email`, `user_slug`, `prof_description`, `prof_image`, `tot_review`, `avg_review`, `lattitude`, `longitude`, `job_category`.`category_name`, `(3956 * 2 * ASIN(SQRT( POWER(SIN((9`.`809916 - lattitude) * pi()/180 / 2), 2) +COS( 9`.`809916 * pi()/180) * COS(lattitude * pi()/180) * POWER(SIN(( -76`.`398022 - longitude) * pi()/180 / 2), 2) )))` as `distance` from `users` left join `job_category` on `users`.`primary_trade` = `job_category`.`category_id` where `primary_trade` = ? having `distance` <= ? order by `distance` asc

select (3956 * 2 * ASIN(SQRT( POWER(SIN((CAST(9.809916 AS decimal(10,6))) - lattitude) * pi()/180 / 2), 2) +COS(CAST(9.809916 AS decimal(10,6))) * pi()/180) * COS(lattitude * pi()/180) * POWER(SIN((CAST(-76.398022 AS decimal(10,6))) - longitude) * pi()/180 / 2), 2) as distance from `users` left join `job_category` on `users`.`primary_trade` = `job_category`.`category_id` where `primary_trade` = 14 having `distance` <= 10 order by `distance` asc


select (3956 * 2 * ASIN(SQRT(POWER(SIN((CAST(9.809916 AS decimal(10,6)) - lattitude) * pi()/180 / 2), 2) + COS(CAST(9.809916 AS decimal(10,6)) * pi()/180) * COS(lattitude * pi()/180) * POWER(SIN((CAST(-76.398022 AS decimal(10,6)) - longitude) * pi()/180 / 2), 2)))) as distance from `users` left join `job_category` on `users`.`primary_trade` = `job_category`.`category_id` where `primary_trade` = 14 having `distance` <= 10 order by `distance` asc


select (3956 * 2 * ASIN(SQRT(POWER(SIN((CAST(9.809916 AS decimal(10,6)) - lattitude) * pi()/180 / 2), 2) + COS(CAST(9.809916 AS decimal(10,6)) * pi()/180) * COS(lattitude * pi()/180) * POWER(SIN((CAST(-76.398022 AS decimal(10,6)) - longitude) * pi()/180 / 2), 2)))) as ANY_VALUE(distance) from `users` left join `job_category` on `users`.`primary_trade` = `job_category`.`category_id` where `primary_trade` = 14 having `distance` <= 10 order by `distance` asc


Non-grouping field 'distance' is used in HAVING clause 