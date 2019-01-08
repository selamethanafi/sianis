ALTER TABLE `sieka_harian` ADD `kuantitas` INT(1) NULL AFTER `menit_selesai`, ADD `satuan` INT NOT NULL AFTER `kuantitas`;
CREATE TABLE `m_penerimaan` (
  `macam_penerimaan` text,
  `nomor` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_penerimaan`
--
ALTER TABLE `m_penerimaan`
  ADD PRIMARY KEY (`nomor`);
CREATE TABLE `penerimaan` (
  `id` bigint(20) NOT NULL,
  `id_m_penerimaan` bigint(20) NOT NULL,
  `besar` int(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penerimaan`
--
ALTER TABLE `penerimaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
