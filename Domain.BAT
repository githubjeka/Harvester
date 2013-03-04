@echo off  
cd assets
del domain.txt
for /f "eol=Š tokens=1 skip=3 delims=\ " %%D in ('net view /domain') do (echo %%D>>domain.txt) 
for /f "eol=Š tokens=1 delims=\ " %%D in (domain.txt) do (del  %%D.txt) 