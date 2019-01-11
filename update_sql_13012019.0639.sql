CREATE TABLE `jurnal_ekstrakurikuler` (
  `id` bigint(20) NOT NULL,
  `kodeguru` varchar(100) DEFAULT NULL,
  `thnajaran` varchar(9) DEFAULT NULL,
  `semester` varchar(1) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurnal_ekstrakurikuler`
--
ALTER TABLE `jurnal_ekstrakurikuler`
  ADD PRIMARY KEY (`id`);
