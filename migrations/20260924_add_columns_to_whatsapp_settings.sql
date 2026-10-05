-- Migration: Add missing columns to whatsapp_settings table
-- Created: 2026-09-24

ALTER TABLE `whatsapp_settings`
  ADD COLUMN IF NOT EXISTS `business_id` VARCHAR(100) NULL AFTER `company_id`,
  ADD COLUMN IF NOT EXISTS `connected_at` DATETIME NULL AFTER `connection_status`,
  ADD COLUMN IF NOT EXISTS `created_at` DATETIME NULL AFTER `updated_at`;
