CREATE TABLE `resellerwallet` (
  `id` int(11) NOT NULL,
  `anumber` varchar(40) NOT NULL,
  `aword` varchar(255) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `requested_by` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `contactnumber` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `salesmanager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `resellerwallet` (`id`, `anumber`, `aword`, `payment_type`, `date`, `requested_by`, `customer_name`, `contactnumber`, `email`, `profile_img`, `remark`, `salesmanager_id`) VALUES
(1, '10000', 'TenThousand only', 'Cash', '2023-07-06', 'kk', '09piri', '98940034402', 'prabin122@gmail.com', 'profile_images/docs1.jpg', '09', 3),
(2, '10000', 'TenThousand only', 'Online Transfer', '2023-06-29', 'KiKi9', 'KiKi99', '9840066611', 'salesfirst01@gmail.com', 'profile_images/profile3.JPG', '9999', 3);

ALTER TABLE `resellerwallet`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `resellerwallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
