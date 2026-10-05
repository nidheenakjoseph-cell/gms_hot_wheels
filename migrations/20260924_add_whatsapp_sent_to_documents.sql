-- Persist WhatsApp send state for document list buttons.
ALTER TABLE `estimations`
  ADD COLUMN IF NOT EXISTS `whatsapp_sent` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `whatsapp_sent_at` DATETIME NULL;

ALTER TABLE `quotations`
  ADD COLUMN IF NOT EXISTS `whatsapp_sent` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `whatsapp_sent_at` DATETIME NULL;

ALTER TABLE `job_cards`
  ADD COLUMN IF NOT EXISTS `whatsapp_sent` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `whatsapp_sent_at` DATETIME NULL;